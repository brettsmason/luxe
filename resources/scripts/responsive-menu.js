export default class ResponsiveMenu {
	constructor(container, options) {
		const defaults = {
			submenuClass: 'menu__item--has-children',
			submenuToggleClass: 'menu__submenu-toggle',
			menuToggleClass: 'menu__toggle',
			menuClass: 'menu__items',
			screenReaderClass: 'screen-reader-text',
			openSubmenuText: 'Open submenu',
			closeSubmenuText: 'Close submenu',
			submenuToggleIcon: menuIcons.submenuToggleIcon,
			dropdownMenuIcon: menuIcons.dropdownMenuIcon
		};

		// Merge defaults with our passed options
		this.options = { ...defaults, ...options };

		this.container = document.getElementById(container);
		this.menu = this.container.getElementsByTagName('ul')[0];
		this.menuToggle = this.container.getElementsByTagName('button')[0];
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
		this._setStates();
	}

	// Handle all events
	_events() {
		// Remove ARIA when on 'desktop'.
		window.addEventListener('resize', () => this._setStates());
		window.addEventListener('resize', () => this._createSubmenuButtons());
		window.addEventListener('resize', () => this._removeSubmenuButtons());

		// Toggle ARIA states of main ul on click.
		this.menuToggle.addEventListener('click', () => {
			this._toggle(this.menuToggle, true);
		});

		// Close menu using Esc key.
		document.addEventListener('keyup', event => {
			if (27 === event.keyCode) {
				if (this._isMenuOpen()) {
					this._toggle(this.menuToggle, true);
					this.menuToggle.focus();

					let toggles = document.getElementsByClassName('menu__submenu-toggle');

					[...toggles].forEach(toggle => {
						toggle.setAttribute('aria-expanded', 'false');
					});
				}
			}
		});
	}

	// Toggle aria-expanded state when button is pressed
	_toggle(element, height = false) {
		let expanded =
			'false' === element.getAttribute('aria-expanded') ? true : false;
		element.setAttribute('aria-expanded', expanded);

		if(height) {
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
				if (!element.classList.contains('has-submenu-toggle')) {
					let anchor = element.getElementsByTagName('a')[0];
					let submenu = element.getElementsByTagName('ul')[0];
					let submenuToggle = document.createElement('button');
					let id = `submenu-${this._createUUID()}`;
					let submenuToggleText = this.options.openSubmenuText;
					let submenuToggleIcon = this.options.submenuToggleIcon;

					element.classList.add('has-submenu-toggle');

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
			let toRemove = document.getElementsByClassName('menu__submenu-toggle');

			[...toRemove].forEach(button => {
				button.removeEventListener('click', () => this._toggle(button));
				button.parentNode.classList.remove('has-submenu-toggle');
				button.parentNode.removeChild(button);
			});
		}
	}

	_setStates() {
		if (this._isMobile()) {
			this.container.classList.add('menu--is-mobile');
			this.container.classList.remove('menu--is-desktop');
			this.menuToggle.setAttribute('aria-expanded', 'false');

			[...this.submenus].forEach(submenu => {
				submenu.removeAttribute('aria-haspopup');
			});
		} else {
			this.container.classList.add('menu--is-desktop');
			this.container.classList.remove('menu--is-mobile');
			this.menuToggle.setAttribute('aria-expanded', 'false');

			[...this.submenus].forEach(submenu => {
				submenu.setAttribute('aria-haspopup', 'true');
			});
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
}
