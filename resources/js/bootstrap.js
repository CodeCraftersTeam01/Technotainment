import axios from 'axios';
import Editor from '@toast-ui/editor';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Editor = Editor;
