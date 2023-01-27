/**
 * External dependencies
 */
import { render } from "@wordpress/element";

/**
 * Internal dependencies
 */
import "./style.scss";

/**
 * We're getting the title and slug from the wp_localize_script() function in the PHP file.
 */
const { title, slug } = wpReactBackendSettings;
const components = [];

/**
 * Compoeent that comes from the plugins using this feature. It will be rendered in the settings page.
 * @param {React.Element} Component
 */
export const registerSettingsPanel = (Component) => {
  components.push(Component);
};

/**
 * Wrapper component. Returns the title and the container for the components that are registered.
 * @returns {JSX.Element} The settings wrapper.
 */
const Settings = () => {
  return (
    <div>
      <h1>{title}</h1>
      <div className={slug}></div>
    </div>
  );
};

/**
 * Renders the settings wrapper first, then renders the components that are registered.
 */
window.addEventListener("load", function () {
  const wrapper = document.querySelector(".wp-react-backend-settings-wrapper");
  if (!wrapper) {
    return;
  }
  const attributes = wrapper.dataset;
  render(<Settings {...attributes} />, wrapper);

  const inner = document.querySelector("." + slug);
  if (!inner) {
    return;
  }
  render(
    <div>
      {components.map((component) => {
        return component;
      })}
    </div>,
    inner
  );
});
