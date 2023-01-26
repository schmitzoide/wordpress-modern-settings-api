import { render } from "@wordpress/element";

import "./style.scss";

const { slug } = wpReactBackendSettings;

const Settings = () => {
  return (
    <div>
      <h1>Settings</h1>
      <div className={slug}></div>
    </div>
  );
};

window.addEventListener("load", function () {
  const wrapper = document.querySelector(".wp-react-backend-settings-wrapper");
  if (!wrapper) {
    return;
  }
  const attributes = wrapper.dataset;
  render(<Settings {...attributes} />, wrapper);
});
