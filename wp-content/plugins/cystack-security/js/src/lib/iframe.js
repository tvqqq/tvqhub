import $ from 'jquery';
import { initInterframe } from './Interframe';
import { iframeUrl } from '../constants/cystackConfig';

export const createIframe = () => {
    const container = $('#cystack-iframe-container');
    const $iframe = $(`<iframe id="cystack-iframe" src="${iframeUrl}"></iframe>`);
    initInterframe($iframe[0]);
    container.append($iframe);
};
