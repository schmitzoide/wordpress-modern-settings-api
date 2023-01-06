/**
 * Settings's Header
 * @MenuName: Custom Settings
 */

/**
 * External dependencies
 */
import { render } from "@wordpress/element";

/**
 * Internal dependencies
 */
import Settings from "./index.js";

/**
 * This allows the block to render React components on the frontend.
 */
// eslint-disable-next-line @wordpress/no-global-event-listener
window.addEventListener("load", function () {
    const page = wp_react_backend_settings_options.page;
    const wrapper = document.querySelector(
        ".wp-react-backend-settings-wrapper_" + page
    );
    if (wrapper) {
        const attributes = { ...wrapper.dataset };
        Object.keys(attributes).forEach((key) => {
            try {
                attributes[key] = JSON.parse(attributes[key]);
            } catch (e) {
                // We just ignore if it doesn't need to be parsed.
            }
        });
        const id = `wp-react-backend-settings_${page}`;
        render(<Settings id={id} attributes />, wrapper);
    }
});
