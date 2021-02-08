const options: mmOptionsDividers = {
    add: false,
    addTo: 'panels'
};
export default options;

/**
 * Extend shorthand options.
 *
 * @param  {object} options The options to extend.
 * @return {object}			The extended options.
 */
export function extendShorthandOptions(
    options: mmOptionsDividers
): mmOptionsDividers {
    if (typeof options == 'boolean') {
        options = {
            add: options
        };
    }

    if (typeof options != 'object') {
        options = {};
    }

    if (options.addTo == 'panels') {
        options.addTo = '.mm-listview';
    }

    return options;
}
