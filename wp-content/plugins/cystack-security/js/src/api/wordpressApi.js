import { post } from './wordpressClient';

export function cystackConnectTarget(targetInfo) {
  return post('cystack_registration_ajax', targetInfo);
}

export function cystackDisconnectTarget() {
  return post('cystack_disconnect_ajax', {});
}

export function cystackClearMetaTag() {
  return post('cystack_clear_meta_ajax', {});
}

export function cystackUpdateEmail(data) {
  return post('cystack_update_email_ajax', data);
}