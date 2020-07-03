import $ from 'jquery';
import { ajaxUrl, nonce } from '../constants/cystackConfig';

function makeRequest(action, method, payload) {
  const url = `${ajaxUrl}?action=${action}&_ajax_nonce=${nonce}`;
  return new Promise((resolve, reject) => {
    const ajaxPayload = {
      url,
      method,
      contentType: 'application/json',
      success: data => resolve(data),
      error: error => reject(error),
    };

    if (payload) {
      ajaxPayload.data = JSON.stringify(payload);
    }
    $.ajax(ajaxPayload);
  });
}

export function post(action, payload) {
  const request = makeRequest(action, 'post', payload);
  return request;
}