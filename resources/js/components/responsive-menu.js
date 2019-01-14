export default class ResponsiveMenu {
	constructor(container, options) {
		const defaults = {
			animateToggle: true,
			menuToggle: 'menu-toggle',
			submenuClass: 'has-children',
			submenuToggleClass: 'menu__sub-menu-toggle',
			menuToggleClass: 'menu__toggle',
			menuClass: 'menu__items',
			screenReaderClass: 'screen-reader-text',
			openSubmenuText: 'Open sub menu',
			closeSubmenuText: 'Close sub menu',
			submenuToggleIcon: menuIcons.submenuToggleIcon,
			dropdownMenuIcon: menuIcons.dropdownMenuIcon
		};

		// Merge defaults with our passed options
		this.options = { ...defaults, ...options };

		this.container = document.getElementById(container);
		this.menu = this.container.getElementsByTagName('ul')[0];
		this.menuToggle = document.getElementById(this.options.menuToggle);
		this.submenus = this.container.getElementsByClassName(
			this.options.submenuClass
		);
		this.submenuToggles = this.menu.getElementsByClassName(
			this.options.submenuToggleClass
		);

		// Setup the menu
		this._init();

		// Setup event listeners
		this._events();
	}

	// Handle everything that happens before events
	_init() {
		this.menuToggle.setAttribute('aria-expanded', 'false');
		this._createSubmenuButtons();
		this._createDropdownIcons();
		this._setStates();
	}

	// Handle all events
	_events() {
		// Remove ARIA when on 'desktop'.
		window.addEventListener('resize', () => this._setStates());
		window.addEventListener('resize', () => this._createSubmenuButtons());
		window.addEventListener('resize', () => this._removeSubmenuButtons());
		window.addEventListener('resize', () => this._createDropdownIcons());
		window.addEventListener('resize', () => this._removeDropdownIcons());

		// Toggle ARIA states of main ul on click.
		this.menuToggle.addEventListener('click', () => {
			this._toggle(this.menuToggle, this.options.animateToggle);
			this._trapFocus();
		});

		// Get all the link elements within the menu.
		var links = this.menu.getElementsByTagName( 'a' );

		// Each time a menu link is focused or blurred, toggle focus.
		for (var i = 0; i < links.length; ++i) {
			links[i].addEventListener( 'focus', this._toggleFocusWithin, true );
			links[i].addEventListener( 'blur', this._toggleFocusWithin, true );
		}

		// Close menu using Esc key.
		document.addEventListener('keyup', event => {
			if (27 === event.keyCode) {
				if (this._isMenuOpen()) {
					this._toggle(this.menuToggle, this.options.animateToggle);
					this.menuToggle.focus();

					let toggles = document.getElementsByClassName('menu__sub-menu-toggle');

					[...toggles].forEach(toggle => {
						toggle.setAttribute('aria-expanded', 'false');
					});
				}
			}
		});
	}

	// Toggle aria-expanded state when button is pressed
	_toggle(element, height = true) {
		let expanded =
			'false' === element.getAttribute('aria-expanded') ? true : false;
		element.setAttribute('aria-expanded', expanded);

		if(height === true) {
			if(expanded) {
				this._expandElement(element.nextElementSibling);
			} else {
				this._collapseElement(element.nextElementSibling);
			}
		}
	}

	// Add submenu button to any element that has children
	_createSubmenuButtons() {
		if(this._isMobile()) {
			[...this.submenus].forEach(element => {
				if (!element.classList.contains('has-sub-menu-toggle')) {
					let anchor = element.getElementsByTagName('a')[0];
					let submenu = element.getElementsByTagName('ul')[0];
					let submenuToggle = document.createElement('button');
					let id = `submenu-${this._createUUID()}`;
					let submenuToggleText = this.options.openSubmenuText;
					let submenuToggleIcon = this.options.submenuToggleIcon;

					element.classList.add('has-sub-menu-toggle');

					// Add our new unique ID as an ID to the submenu
					submenu.setAttribute('id', id);

					// Add our new unique ID to match up with the button.
					submenuToggle.setAttribute('aria-controls', id);

					// Set aria-expanded to false by default.
					submenuToggle.setAttribute('aria-expanded', false);

					// Add class to button.
					submenuToggle.classList.add(this.options.submenuToggleClass);

					// Add icon to button - temporary to help visualise
					submenuToggle.innerHTML = `<span class='${
						this.options.screenReaderClass
					}'>${submenuToggleText}</span>${submenuToggleIcon}`;

					// Add our new button after the anchor.
					anchor.after(submenuToggle);

					submenuToggle.addEventListener('click', () => this._toggle(submenuToggle, true));
				}
			});
		}
	}

	// Remove submenu toggles
	_removeSubmenuButtons() {
		if(!this._isMobile()) {
			let toRemove = document.getElementsByClassName('menu__sub-menu-toggle');

			[...toRemove].forEach(button => {
				button.removeEventListener('click', () => this._toggle(button));
				button.parentNode.classList.remove('has-sub-menu-toggle');
				button.parentNode.removeChild(button);
			});
		}
	}

	// Add dropdown icons if not on mobile
	_createDropdownIcons() {
		if (!this._isMobile()) {
			let anchors = this.container.querySelectorAll('.has-children > .menu__link');

			for (var i = 0; i < anchors.length; ++i) {
				if (!anchors[i].classList.contains('has-dropdown-icon')) {
					anchors[i].classList.add('has-dropdown-icon');
					anchors[i].innerHTML = anchors[i].innerHTML + this.options.dropdownMenuIcon;
				}
			}
		}
	}

	// Remove the dropdown icons on mobile
	_removeDropdownIcons() {
		if (this._isMobile()) {
			var icons = this.container.querySelectorAll('.menu__dropdown-icon');

			for (var i = 0; i < icons.length; ++i) {
				icons[i].parentNode.classList.remove('has-dropdown-icon');
				icons[i].parentNode.removeChild(icons[i]);
			}
		}
	}

	// Set initial state of our menu depending on menu state
	_setStates() {
		if (this._isMobile()) {
			this.menuToggle.setAttribute('aria-expanded', 'false');

			[...this.submenus].forEach(submenu => {
				submenu.removeAttribute('aria-haspopup');
			});
		} else {
			this.menuToggle.setAttribute('aria-expanded', 'false');
			this.menu.style.removeProperty('height');
		}
	}

	// Used to determind if we are on mobile or not
	// If menu toggle button has display: none css rule, we're on desktop.
	_isMobile() {
		let isMobile =
			'none' ===
			window.getComputedStyle(this.menuToggle, null).getPropertyValue('display')
				? false
				: true;
		return isMobile;
	}

	_isMenuOpen() {
		let isMenuOpen =
			'false' === this.menuToggle.getAttribute('aria-expanded') ? false : true;
		return isMenuOpen;
	}

	// Function to generate a Unique ID that can be used for the ID's for submenus, buttons etc
	_createUUID() {
		var s = [];
		var hexDigits = '0123456789abcdef';
		for (var i = 0; i < 36; i++) {
			s[i] = hexDigits.substr(Math.floor(Math.random() * 0x10), 1);
		}
		s[14] = '4'; // bits 12-15 of the time_hi_and_version field to 0010
		s[19] = hexDigits.substr((s[19] & 0x3) | 0x8, 1); // bits 6-7 of the clock_seq_hi_and_reserved to 01
		s[8] = s[13] = s[18] = s[23] = '-';

		var uuid = s.join('');
		return uuid;
	}

	_collapseElement(element) {
		// get the height of the element's inner content, regardless of its actual size
		var sectionHeight = element.scrollHeight;

		// temporarily disable all css transitions
		var elementTransition = element.style.transition;
		element.style.transition = '';

		// on the next frame (as soon as the previous style change has taken effect),
		// explicitly set the element's height to its current pixel height, so we
		// aren't transitioning out of 'auto'
		requestAnimationFrame(function() {
		  element.style.height = sectionHeight + 'px';
		  element.style.transition = elementTransition;

		  // on the next frame (as soon as the previous style change has taken effect),
		  // have the element transition to height: 0
		  requestAnimationFrame(function() {
			element.style.height = 0;
		  });
		});
	}

	_expandElement(element) {
		// get the height of the element's inner content, regardless of its actual size
		var sectionHeight = element.scrollHeight;

		// have the element transition to the height of its inner content
		element.style.height = sectionHeight + 'px';

		// when the next css transition finishes (which should be the one we just triggered)
		element.addEventListener('transitionend', function transitionEnd(event) {
		  // remove this event listener so it only gets triggered once
		  element.removeEventListener('transitionend', transitionEnd, false);

		  // remove "height" from the element's inline styles, so it can return to its initial value
		  element.style.height = 'auto';
		}, false);
	}

	/**
	 * Trap focus when nav is open.
	 */
	_trapFocus() {

		// Bail if menu is not open.
		if (!this._isMenuOpen()) {
			return;
		}

		// Set focusable elements inside main navigation.
		let focusableElements     = this.container.querySelectorAll( [ 'a[href]', 'area[href]', 'input:not([disabled])', 'select:not([disabled])', 'textarea:not([disabled])', 'button:not([disabled])', 'iframe', 'object', 'embed', '[contenteditable]', '[tabindex]:not([tabindex^="-"])' ] );
		let firstFocusableElement = focusableElements[0];
		let lastFocusableElement  = focusableElements[focusableElements.length - 1];

		// Redirect last Tab to first foc	usable element.
		lastFocusableElement.addEventListener( 'keydown', function(e) {
			if ((9 === e.keyCode && !e.shiftKey)) {
				e.preventDefault();
				firstFocusableElement.focus(); // Set focus on first element - that's actually close menu button.
			}
		} );

		// Redirect first Shift+Tab to toggle button element.
		firstFocusableElement.addEventListener('keydown', function(e) {
			if ((9 === e.keyCode && e.shiftKey)) {
				e.preventDefault();
				firstFocusableElement.focus(); // Set focus on first element.
			}
		});

		// Redirect Shift+Tab from the toggle button to last focusable element.
		this.menuToggle.addEventListener('keydown', function(e) {
			if ((9 === e.keyCode && e.shiftKey)) {
				e.preventDefault();
				lastFocusableElement.focus(); // Set focus on last element.
			}
		} );
	}

	/**
	 * Sets or removes .focus-within class on an element.
	 */
	_toggleFocusWithin() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .js-nav-menu.
		while ( -1 === self.className.indexOf( 'menu__items' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'has-focus-within' ) ) {
					self.className = self.className.replace( 'has-focus-within', '' );
				} else {
					self.className += ' has-focus-within';
				}
			}

			self = self.parentElement;
		}
	}
}
