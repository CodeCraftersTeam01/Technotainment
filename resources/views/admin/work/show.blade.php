<x-admin.layout>
    <div class="w-full h-full bg-white shadow-lg rounded-3xl p-5">
        <h1 class="text-3xl font-semibold">Detail {{ $work->work_title }}</h1>
        <form id="createEventForm" action="{{ route('works.update', $work->work_id) }}" method="POST"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Team Name -->
            <x-form.input label="Team Name" id="team_name" name="team_name" type="text" disabled :default="$work->team->team_name" />
                
            <!-- Team Token -->
            <x-form.input label="Team Token" id="token" name="token" type="text" :default="$work->team->team_token" disabled />
            
            <!-- Work Title -->
            <x-form.input label="Work Title" id="work_title" name="work_title" type="text" disabled :default="$work->work_title" />
            
            {{-- Invoice status --}}
            <p class="text-sm font-medium text-gray-700">Invoice</p>
            <p class="text-sm p-2 border rounded-lg w-fit font-medium 
            @if($work->team->team_invoice_status == 'accept')
            {{ 'bg-green-500 text-white' }}
            @elseif($work->team->team_invoice_status == 'decline')
            {{ 'bg-red-500 text-white' }}
            @else
            {{ 'bg-white text-gray-700' }}
            @endif
            ">
                {{ $work->team->team_invoice ? 'Paid' : 'Unpaid' }}
            </p>

            <!-- Work -->
            <p class="text-sm font-medium text-gray-700">Work</p>
            {{-- ui/ux --}}
            @if($work->team->competition->slug == '7lTI2n5EDK')
                @if ($work->work)
                    <a href="{{ $work->work }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                          </svg>                          
                        View Work
                    </a>
                @else
                    <span class="text-gray-400">No Link</span>
                @endif
            {{-- web design --}}
            @elseif($work->team->competition->slug == 'I5njJtbe5J')
                @if ($work->work)
                    <a href="{{ Storage::url($work->work) }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        View Work
                    </a>
                @else
                    <span class="text-gray-400">No document</span>
                @endif
            @endif

            @if($work->team->competition->slug == '7lTI2n5EDK')
                <!-- Work Abstract -->
                <p class="text-sm font-medium text-gray-700">Work Abstract</p>
                @if ($work->work_abstract)
                    <a href="{{ Storage::url($work->work_abstract) }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        View Abstract
                    </a>
                @else
                    <span class="text-gray-400">No Abstract</span>
                @endif

                <!-- Work Proposal -->
                <p class="text-sm font-medium text-gray-700">Work Proposal</p>
                @if ($work->work_proposal)
                    <a href="{{ Storage::url($work->work_proposal) }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        View Proposal
                    </a>
                @else
                    <span class="text-gray-400">No Proposal</span>
                @endif

                <!-- Work PPT -->
                <p class="text-sm font-medium text-gray-700">Work PPT</p>
                @if ($work->work_ppt)
                    <a href="{{ Storage::url($work->work_ppt) }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        View PPT
                    </a>
                @else
                    <span class="text-gray-400">No PPT</span>
                @endif

            @elseif($work->team->competition->slug == 'I5njJtbe5J')
                <p class="text-sm font-medium text-gray-700">Work Link Demo</p>
                @if($work->work_link)
                    <a href="{{ $work->work_link }}" target="_blank"
                        class="text-indigo-600 hover:text-indigo-900 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                        </svg>                          
                        View Link Demo
                    </a>
                @else
                    <span class="text-gray-400">No Link Demo</span>
                @endif
            @endif

            <!-- Work original -->
            <p class="text-sm font-medium text-gray-700">Work Original</p>
            @if ($work->work_original)
                <a href="{{ Storage::url($work->work_original) }}" target="_blank"
                    class="text-indigo-600 hover:text-indigo-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    View Original
                </a>
            @else
                <span class="text-gray-400">No Original</span>
            @endif

            <!-- First Regist at -->
            <p class="text-sm font-medium text-gray-700">First Regist At</p>
            <span class="text-gray-400">{{ $work->team->created_at->format('d M Y') }}</span>

            <!-- Work First Submit at -->
            <p class="text-sm font-medium text-gray-700">Work First Submit At</p>
            <span class="text-gray-400">{{ $work->created_at->format('d M Y') }}</span>

            <!-- Work Updated at -->
            <p class="text-sm font-medium text-gray-700">Work Updated At</p>
            <span class="text-gray-400">{{ $work->updated_at->format('d M Y') }}</span>

            <div class="mb-6 flex justify-end">
                <a href="{{ route('works.index', ['status' => 'active']) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mr-2">
                    Back
                </a>
                <a href="{{ route('teams.edit', $work->team->team_id) }}"
                    class="bg-gray-200 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-2">
                    Edit Team
                </a>
            </div>
        </form>
    </div>
</x-admin.layout>
