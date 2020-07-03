import { connectToChild } from 'penpal';
import * as cystackConfig from '../constants/cystackConfig';
import { cystackClearQueryParam, getQueryParam } from '../utils/queryParams';
import { cystackGetTargetInfo } from '../utils/targetInfo';
import {
  cystackClearMetaTag,
  cystackConnectTarget,
  cystackDisconnectTarget,
  cystackUpdateEmail
} from '../api/wordpressApi';

const cystackPageReload = () => window.location.reload(true);
const cystackPageRedirect = feature => {
  window.history.replaceState(null, null, `?page=cystack_${feature}`);
  cystackPageReload();
};
const methods = {
  cystackClearQueryParam,
  cystackClearMetaTag,
  cystackPageReload,
  cystackPageRedirect,
  cystackGetTargetInfo,
  cystackConnectTarget,
  cystackDisconnectTarget,
  cystackUpdateEmail,
  getCystackConfig: () => cystackConfig,
};

const REDIRECT = 'REDIRECT';
const cystackBaseUrl = cystackConfig.cystackBaseUrl;

function createConnectionToiFrame(iframe) {
  return connectToChild({
    // The iframe to which a connection should be made
    iframe,
    childOrigin: cystackBaseUrl,
    // Methods the parent is exposing to the child
    methods
  });
}

export function initInterframe(iframe) {
  if (!iframe) return;
  if (!window.cystackChildFrameConnection) {
    window.cystackChildFrameConnection = createConnectionToiFrame(iframe);
  }
  const handleNavigation = event => {
    if (event.origin !== cystackBaseUrl) return;
    try {
      const data = JSON.parse(event.data);
      // handle here
    } catch (e) {
      // Error in parsing message
    }
  };

  window.addEventListener('message', handleNavigation);

  const redirectToLogin = event => {
    if (event.data === 'unauthorized') {
      window.removeEventListener('message', redirectToLogin);
      iframe.src = cystackConfig.loginUrl;
    }
  };

  const currentPage = getQueryParam('page');
  if (currentPage !== 'cystack') {
    window.addEventListener('message', redirectToLogin);
  }

}
