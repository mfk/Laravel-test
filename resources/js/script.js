import 'bootstrap';
import './vendor/notify.min';

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

import './utils';
import './articles';