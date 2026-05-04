<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Work;
use App\Models\Event;
use App\Models\Sponsor;
use App\Models\MemberTeam;
use App\Models\Competition;
use Illuminate\Support\Str;
use App\Models\Announcement;
use App\Models\MediaPartner;
use App\Models\WorkDeadline;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\TeamResource;
use App\Http\Resources\WorkResource;
use App\Http\Resources\EventResource;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CompetitionResource;
use App\Http\Resources\AnnouncementResource;

class GuestController extends Controller
{
    /**
     * view index of web
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $event = Event::with('competitions')->where('event_status', 'active')->first();
        if ($event) {
            $mediaPartners = MediaPartner::where('event_id', $event->event_id)->get();
            $sponsors = Sponsor::where('event_id', $event->event_id)->get();
            $esports = Competition::where('event_id', $event->event_id)
                ->where('competition_status', 'active')
                ->where('competition_type', 'E-Sports')
                ->with(['achievements'])
                ->get();
            $nonesports = Competition::where('event_id', $event->event_id)
                ->where('competition_status', 'active')
                ->where('competition_type', 'Non-E-Sports')
                ->with(['achievements'])
                ->get();
            $announcement = Announcement::whereHas('event',
            function ($q) {
                $q->where('event_status', 'active');
            })
                ->orderBy('updated_at', 'desc')
                ->limit(3)
                ->get();
            $data = [
                'event' => $event,
                'mediaPartners' => $mediaPartners,
                'sponsors' => $sponsors,
                'esports' => $esports,
                'nonesports' => $nonesports,
                'announcement' => $announcement
            ];
        } else {
            $data = [
                'event' => null,
                'mediaPartners' => null,
                'sponsors' => null,
                'esports' => null,
                'nonesports' => null,
            ];
        }
        return view('guest.index', $data);
    }

    /**
     * Summary of competition
     * @param \App\Models\Competition $competition
     * @return \Illuminate\Contracts\View\View
     */
    public function competition(Competition $competition)
    {
        // get competition's slug
        $slug = $competition->slug;

        // get event where slug right on url
        $event = Event::with('competitions')->where('event_status', 'active')
            ->whereHas('competitions', function ($query) use ($slug) {
                $query->where('slug', $slug);
            })->first();
        // if event is not active
        if (!$event) {
            abort('404');
        }

        $competition->load([
            'achievements',
            'timelines',
        ]);

        return view('guest.competition', [
            'competition' => new CompetitionResource($competition),
        ]);
    }

    /**
     * Summary of registration
     * @param \App\Models\Competition $competition
     * @return \Illuminate\Contracts\View\View
     */
    public function registration(Competition $competition)
    {
        $event = Event::with('competitions')->where('event_status', 'active')->first();

        if ($competition->competition_status == 'nonactive') {
            abort('404');
        } elseif($competition->competition_end_date < Carbon::parse(now())->format('Y-m-d')) {
            abort('404');
        }

        $data = [
            'competition' => new CompetitionResource($competition),
            'event' => $event,
        ];
        $type = $competition->competition_view_template;

        if ($type == 'mobilelegend') {
            return view('guest.mobilelegend', $data);
        } elseif ($type == 'pes') {
            return view('guest.pes', $data);
        } elseif ($type == 'uiux') {
            return view('guest.uiux', $data);
        } elseif ($type == 'webdesign') {
            return view('guest.webdesign', $data);
        } else {
            abort('404');
        }
    }


    /**
     * Store Registration Competition for Guest
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */

    public function registrationStore(Request $request)
    {
        $slug = $request->input('slug');
        $competition = Competition::where('slug', $slug)->firstOrFail();
        $type = $competition->competition_view_template;

        // Validasi dasar yang selalu diperlukan
        $baseRules = [
            'team_name' => 'required|string',
            'team_logo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'team_email' => 'required|string|email',
            'team_contact' => 'required|string',
            'team_instance' => 'in:YES,NO',
            'team_instance_name' => 'nullable|string',
            'slug' => 'required|exists:competitions,slug',
            'team_invoice' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];

        if ($type == 'pes') {
            unset($baseRules['team_logo']);
        }

        // Konfigurasi aturan member berdasarkan slug
        $slugMemberRules = [
            'mobilelegend' => 6, // Mobile Legends
            'pes' => 1, // PES
            'uiux' => 3, // UI/UX
            'webdesign' => 3, // Web Designer
        ];

        // jika ui/ux hapus team_invoice dan tambahkan work_abstract
        if ($type == 'uiux') {
            unset($baseRules['team_invoice']);
            $baseRules['work_abstract'] = 'required|file|mimes:pdf|max:5000';
        }

        if (!array_key_exists($type, $slugMemberRules)) {
            return back()->with('error', 'Kompetisi tidak dikenali.')->withInput();
        }

        $memberCount = $slugMemberRules[$type];
        $baseRules['members'] = "required|array|max:$memberCount";

        for ($i = 0; $i < $memberCount; $i++) {
            $required = ($type === 'mobilelegend' && $i === 5 || $type == 'uiux' && $i == 2 || $type == 'webdesign' && $i == 2) ? 'nullable' : 'required';
            $baseRules["members.$i.name"] = "$required|max:255";
            $baseRules["members.$i.identity"] = "$required|image|mimes:jpeg,png,jpg,webp|max:2048";
        }

        // Jalankan validasi
        $validated = Validator::make($request->all(), $baseRules)->validate();

        try {
            DB::beginTransaction();

            // Buat struktur anggota
            $members = $validated['members'];
            $finalMembers = [];

            foreach ($members as $index => $member) {
                $role = match (true) {
                    $index === 0 => 'Leader',
                    $index === 2 && $type == 'webdesign' => 'Backup',
                    $index === 2 && $type == 'uiux' => 'Backup',
                    $index >= 1 && $index <= 4 => 'Member',
                    $index === 5 => 'Backup',
                    default => null,
                };

                if ($role === 'Backup' && (empty($member['name']) && empty($member['identity']))) {
                    continue;
                }

                if ($member['identity']) {
                    $identityPath = Storage::disk('local')->put($request->team_name . '/team-identities', $member['identity']);
                    $member['identity'] = $identityPath;
                }

                $finalMembers[] = [
                    'member_team_name' => $member['name'],
                    'member_team_identity' => $member['identity'],
                    'member_team_role' => $role,
                ];
            }

            // Simpan data
            $validated['competition_id'] = $competition->competition_id;
            unset($validated['members']);

            // upload file seperti logo team dll
            if (!empty($validated['team_logo'])) {
                $logo_path = $validated['team_logo']->store(Str::slug($request->team_name) . '/team-logos', 'public');
                $validated['team_logo'] = $logo_path;
            }

            if (!empty($validated['team_invoice']) && $type != 'uiux') {
                $invoice_path = Storage::disk('local')->put(Str::slug($request->team_name) . '/team-invoice', $request->file('team_invoice'));
                $validated['team_invoice'] = $invoice_path;
            }

            if (isset($validated['work_abstract'])) {
                $workFile = $validated['work_abstract'];
                $work_path = $workFile->store('works/'. Str::slug($request->team_name) .'/abstract', 'public');

                unset($validated['work_abstract']);
            }

            // generate token uuid
            $validated['team_token'] = Str::uuid();

            $team = Team::create($validated);

            foreach ($finalMembers as $member) {
                $member['team_id'] = $team->team_id;
                MemberTeam::create($member);
            }
            // kalo ui/ux tambahkan work_abstract
            if (isset($work_path)) {
                Work::create([
                    'team_id' => $team->team_id,
                    'work_abstract' => $work_path,
                ]);
            }

            // kalo web designer tambahkan work dengan token
            if ($type == 'webdesign') { // Web Designer
                Work::create([
                    'team_id' => $team->team_id,
                ]); // buat work kosong
            };

            DB::commit();

            return redirect()->route('success.registration')
                ->with('token', $validated['team_token']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error storing registration: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat mendaftar. Mungkin E-Mail yang anda masukkan sudah terdaftar atau file yang anda upload terlalu besar. Silakan coba lagi.');
        }
    }

    /**
     * Store Work for Team
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Team $team
     * @return \Illuminate\Http\RedirectResponse
     */
    public function workStore(Request $request, Team $team)
    {
        $team_token = $request->team_token;
        $work = Work::whereHas('team', function($query) use ($team_token) {
            $query->where('team_token', $team_token);
        })->first();
        $competition = Competition::where('competition_id', $team->competition_id)->first();

        // cek work table
        if (!$work) {
            abort(404);
        }

        // cek competition
        if(!$competition || $competition->conpetition_status == 'nonactive') {
            abort(404);
        }

        $baseRules = [];
        $teamRule = [];
        $errorText = [];
        $teamError = [];

        $type = $competition->competition_view_template;

        // UI/UX
        if ($type == 'uiux') {
            if(isset($request->work) && isset($request->work_proposal) && isset($request->work_original)) {
                $baseRules = [
                    'work' => 'required|string|url|regex:/^https:\/\/(www\.)?figma\.com\/.+$/',
                    'work_title' => 'required|string',
                    'work_proposal' => 'required|file|mimes:pdf|max:5000',
                    'work_original' => 'required|file|mimes:pdf|max:5000',
                ];
                $teamRule = [
                    'team_invoice' => 'required|file|mimes:img,jpg,jpeg,png|max:5000',
                ];
                $errorText = [
                    'work.required' => 'Karya harus diisi',
                    'work.url' => 'Karya harus berupa Link/URL',
                    'work.regex' => 'Karya harus berupa link Figma yang valid (misal: https://www.figma.com/...)',
                    'work_title' => 'Judul karya harus diisi',
                    'work_proposal.required' => 'Proposal harus diisi',
                    'work_proposal.mimes' => 'Format file harus PDF',
                    'work_original.required' => 'Original harus diisi',
                    'work_original.mimes' => 'Format file harus PDF',
                ];
                $teamError = [
                    'team_invoice.required' => 'Invoice harus diisi',
                    'team_invoice.mimes' => 'Format file harus gambar',
                ];
            } elseif(isset($request->work_ppt) && isset($request->team_invoice)) {
                $baseRules = [
                    'work_ppt' => 'required|file|mimes:pptx,ppt',
                ];
                $errorText = [
                    'work_ppt.required' => 'PPT harus diisi',
                    'work_ppt.mimes' => 'Format file harus PPT'
                ];
            }

        // Web Design
        } elseif ($type == 'webdesign') {
            if(isset($request->work) && isset($request->work_link)) {
                $baseRules = [
                    'work' => 'required|file|mimes:zip,rar,7z',
                    'work_title' => 'required|string',
                    'work_link' => 'required|string|url|regex:/^https?:\/\/(www\.)?github\.com\/[A-Za-z0-9_.-]+\/[A-Za-z0-9_.-]+\/?$/',
                    'work_original' => 'required|file|mimes:pdf|max:5000',
                ];
                $errorText = [
                    'work.required' => 'File Project harus diisi',
                    'work.mimes' => 'Format file harus ZIP, RAR atau 7z',
                    'work_title.required' => 'Judul Project harus diisi',
                    'work_link.required' => 'Link Project harus diisi',
                    'work_link.url' => 'Link Project harus berupa Link/URL',
                    'work_link.regex' => 'Link Project harus berupa Link Github yang valid (misal: https://github.com/...)',
                    'work_original.required' => 'Original harus diisi',
                    'work_original.mimes' => 'Format file harus PDF',
                ];
            }
        }

        if($type == 'uiux') {
            if ($request->has('work') && $request->hasFile('work_proposal') && $request->hasFile('team_invoice') && $request->hasFile('work_original')) {
                $validated = Validator::make($request->all(), $baseRules, $errorText)->validate();
                $validated['work'] = $request->work;
                $teamInvoice = Storage::disk('local')->put('works/' . Str::slug($request->team_name) . '/team-invoice', $request->file('team_invoice'));
                $workProposalPath = $request->file('work_proposal')->store('works/' . Str::slug($team->team_name) . '/work-proposal', 'public');
                $workOriginalPath = $request->file('work_original')->store('works/' . Str::slug($team->team_name) . '/work-original', 'public');
                $validated['work_proposal'] = $workProposalPath;
                $validated['work_original'] = $workOriginalPath;
                $validatedInvoice['team_invoice'] = $teamInvoice;
                Team::where('team_id', $team->team_id)->update($validatedInvoice);
                $work->update($validated);
            } elseif ($request->hasFile('work_ppt')) {
                $validatedPPT = Validator::make(['work_ppt' => $request->file('work_ppt')], $baseRules, $errorText)->validate();
                $validatedInvoice = Validator::make(['team_invoice' => $request->file('team_invoice')], $teamRule, $teamError)->validate();
                $workPPT = $request->file('work_ppt')->store('works/' . Str::slug($team->team_name) .'/work-ppt', 'public');
                $validatedPPT['work_ppt'] = $workPPT;
                $work->update($validatedPPT);
            } else {
                return redirect()->route('team.dashboard')->with('error', 'Dokumen gagal disubmit! Periksa kembali dokumen yang anda submit.');
            }
        }elseif($type == 'webdesign') {
            if ($request->hasFile('work') && $request->has('work_link') && $request->hasFile('work_original')) {
                $validated = Validator::make($request->all(), $baseRules, $errorText)->validate();
                $workPath = $request->file('work')->store('works/' . Str::slug($team->team_name) . '/work-zip', 'public');
                $workOriginalPath = $request->file('work_original')->store('works/' . Str::slug($team->team_name) . '/work-original', 'public');
                $validated['work'] = $workPath;
                $validated['work_link'] = $request->work_link;
                $validated['work_title'] = $request->work_title;
                $validated['work_original'] = $workOriginalPath;
                $work->update($validated);
            } else {
                return redirect()->route('team.dashboard')->with('error', 'Dokumen gagal disubmit! Periksa kembali dokumen yang anda submit.');
            }
        }

        return redirect()->route('team.dashboard')->with('success', 'Work berhasil disubmit!');
    }

    public function successRegistration()
    {
        if(!session('token')) {
            abort(404);
        }
        return view('guest.successRegistration', [
            'token' => session('token'),
        ]);
    }

    public function login()
    {
        $event = Event::with('competitions')->where('event_status', 'active')->first();
        // lewat session
        if(session('Kf92xLmT1aZqW7bY4eU3')) {
            $team = Team::with(['members', 'competition', 'works'])->where('team_token', session('Kf92xLmT1aZqW7bY4eU3'))->first();
            return redirect('/team/dashboard')->with(['team' => new TeamResource($team)]);
        }

        return view('guest.login', [
            'event' => $event,
        ]);
    }

    public function loginStore(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'team_token' => 'required|string',
        ],[
            'team_token.required' => 'Token harus diisi',
        ])->validate();

        $team = Team::with(['members', 'competition', 'works'])->where('team_token', $validated['team_token'])->first();

        // lewat request
        if ($team) {
            Session::put('Kf92xLmT1aZqW7bY4eU3', $validated['team_token']);
            return redirect('/team/dashboard')->with('team', new TeamResource($team));
        }

        return back()->with('error', 'Token tidak valid');
    }

    public function dashboard()
    {
        if (!session('Kf92xLmT1aZqW7bY4eU3')) {
            return redirect()->route('team.login');
        }

        $team = Team::with(['members', 'competition', 'works'])->where('team_token', session('Kf92xLmT1aZqW7bY4eU3'))->first();
        $karyaDanProposal = WorkDeadline::where('name', 'Karya & Proposal')->first();
        $ppt = WorkDeadline::where('name', 'PPT')->first();
        $linkDanZip = WorkDeadline::where('name', 'Link Demo & Zip File')->first();

        return view('guest.dashboard', [
            'Kf92xLmT1aZqW7bY4eU3' => session('Kf92xLmT1aZqW7bY4eU3'),
            'team' => new TeamResource($team),
            'karyaDanProposal' => $karyaDanProposal,
            'ppt' => $ppt,
            'linkDanZip' => $linkDanZip,
        ]);
    }

    public function logout()
    {
        Session::forget('Kf92xLmT1aZqW7bY4eU3');
        return redirect('/');
    }

    public function showAnnouncements()
    {
        $announcements = Announcement::with(['event'])->orderByDesc('updated_at')->get();
        $event = Event::where('event_status', 'active')->with(['competitions'])->first();

        return view('guest.announcements', [
            'announcements' => AnnouncementResource::collection($announcements),
            'event' => new EventResource($event),
        ]);
    }

    public function showAnnouncement(Announcement $announcement)
    {
        $announcement->load(['event']);

        return view('guest.announcement', [
            'announcement' => new AnnouncementResource($announcement),
        ]);
    }
}
