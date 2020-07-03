import $ from 'jquery';

import { createIframe } from './lib/iframe';

function main() {
    $(document).ready(() => {
        createIframe();
    });
}

main();