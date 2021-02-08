/**
 * Create an element with classname.
 *
 * @param 	{string}		selector	The nodeName and classnames for the element to create.
 * @return	{HTMLElement}				The created element.
 */
export function create(selector: string): HTMLElement {
    const args = selector.split('.');
    const elem = document.createElement(args.shift());

    //  IE11:
    args.forEach((classname) => {
        elem.classList.add(classname);
    });

    //  Better browsers:
    // elem.classList.add(...args);

    return elem;
}

/**
 * Find all elements matching the selector.
 * Basically the same as element.querySelectorAll() but it returns an actuall array.
 *
 * @param 	{HTMLElement} 	element Element to search in.
 * @param 	{string}		filter	The filter to match.
 * @return	{array}					Array of elements that match the filter.
 */
export function find(
    element: HTMLElement | Document,
    filter: string
): HTMLElement[] {
    return Array.prototype.slice.call(element.querySelectorAll(filter));
}

/**
 * Find all child elements matching the (optional) selector.
 *
 * @param 	{HTMLElement} 	element Element to search in.
 * @param 	{string}		filter	The filter to match.
 * @return	{array}					Array of child elements that match the filter.
 */
export function children(element: HTMLElement, filter?: string): HTMLElement[] {
    const children: HTMLElement[] = Array.prototype.slice.call(
        element.children
    );
    return filter
        ? children.filter((child) => child.matches(filter))
        : children;
}

/**
 * Find text excluding text from within child elements.
 * @param   {HTMLElement}   element Element to search in.
 * @return  {string}                The text.
 */
export function text(element: HTMLElement): string {
    return Array.prototype.slice
        .call(element.childNodes)
        .filter((child) => child.nodeType == 3)
        .map((child) => child.textContent)
        .join(' ');
}

/**
 * Find all preceding elements matching the selector.
 *
 * @param 	{HTMLElement} 	element Element to start searching from.
 * @param 	{string}		filter	The filter to match.
 * @return	{array}					Array of preceding elements that match the selector.
 */
export function parents(element: HTMLElement, filter?: string): HTMLElement[] {
    /** Array of preceding elements that match the selector. */
    let parents: HTMLElement[] = [];

    /** Array of preceding elements that match the selector. */
    let parent = element.parentElement;
    while (parent) {
        parents.push(parent);
        parent = parent.parentElement;
    }

    return filter
        ? parents.filter((parent) => parent.matches(filter))
        : parents;
}

/**
 * Find all previous siblings matching the selecotr.
 *
 * @param 	{HTMLElement} 	element Element to start searching from.
 * @param 	{string}		filter	The filter to match.
 * @return	{array}					Array of previous siblings that match the selector.
 */
export function prevAll(element: HTMLElement, filter?: string): HTMLElement[] {
    /** Array of previous siblings that match the selector. */
    let previous: HTMLElement[] = [];

    /** Current element in the loop */
    let current = element.previousElementSibling as HTMLElement;

    while (current) {
        if (!filter || current.matches(filter)) {
            previous.push(current);
        }
        current = current.previousElementSibling as HTMLElement;
    }

    return previous;
}

/**
 * Get an element offset relative to the document.
 *
 * @param 	{HTMLElement}	 element 			Element to start measuring from.
 * @param 	{string}		 [direction=top] 	Offset top or left.
 * @return	{number}							The element offset relative to the document.
 */
export function offset(element: HTMLElement, direction?: string): number {
    return (
        element.getBoundingClientRect()[direction] +
        document.body[direction === 'left' ? 'scrollLeft' : 'scrollTop']
    );
}

/**
 * Filter out non-listitem listitems.
 * @param  {array} listitems 	Elements to filter.
 * @return {array}				The filtered set of listitems.
 */
export function filterLI(listitems: HTMLElement[]): HTMLElement[] {
    return listitems.filter((listitem) => !listitem.matches('.mm-hidden'));
}

/**
 * Find anchors in listitems (excluding anchor that open a sub-panel).
 * @param  {array} 	listitems 	Elements to filter.
 * @return {array}				The found set of anchors.
 */
export function filterLIA(listitems: HTMLElement[]): HTMLElement[] {
    let anchors = [];
    filterLI(listitems).forEach((listitem) => {
        anchors.push(...children(listitem, 'a.mm-listitem__text'));
    });
    return anchors.filter((anchor) => !anchor.matches('.mm-btn_next'));
}

/**
 * Refactor a classname on multiple elements.
 * @param {HTMLElement} element 	Element to refactor.
 * @param {string}		oldClass 	Classname to remove.
 * @param {string}		newClass 	Classname to add.
 */
export function reClass(
    element: HTMLElement,
    oldClass: string,
    newClass: string
) {
    if (element.matches('.' + oldClass)) {
        element.classList.remove(oldClass);
        element.classList.add(newClass);
    }
}
