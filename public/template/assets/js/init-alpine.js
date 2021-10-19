function data() {
    function getThemeFromLocalStorage() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem("dark")) {
            return JSON.parse(window.localStorage.getItem("dark"));
        }

        // else return their preferences
        return (
            !!window.matchMedia &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
        );
    }

    function setThemeToLocalStorage(value) {
        window.localStorage.setItem("dark", value);
    }

    return {
        dark: getThemeFromLocalStorage(),
        toggleTheme() {
            this.dark = !this.dark;
            setThemeToLocalStorage(this.dark);
        },
        isSideMenuOpen: false,
        toggleSideMenu() {
            this.isSideMenuOpen = !this.isSideMenuOpen;
        },
        closeSideMenu() {
            this.isSideMenuOpen = false;
        },
        isNotificationsMenuOpen: false,
        toggleNotificationsMenu() {
            this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
        },
        closeNotificationsMenu() {
            this.isNotificationsMenuOpen = false;
        },
        isProfileMenuOpen: false,
        toggleProfileMenu() {
            this.isProfileMenuOpen = !this.isProfileMenuOpen;
        },
        closeProfileMenu() {
            this.isProfileMenuOpen = false;
        },
        isPagesMenuOpen: false,
        togglePagesMenu() {
            this.isPagesMenuOpen = !this.isPagesMenuOpen;
        },
        // isPenggunaMenuOpen: false,
        isPenggunaMenuOpen: true,
        togglePenggunaMenu() {
            this.isPenggunaMenuOpen = !this.isPenggunaMenuOpen;
        },
        isPrenatalClassMenuOpen: true,
        togglePrenatalClassMenu() {
            this.isPrenatalClassMenuOpen = !this.isPrenatalClassMenuOpen;
        },
        isUserMenuOpen: false,
        toggleUserMenu() {
            this.isUserMenuOpen = !this.isUserMenuOpen;
        },
        // dropdown sidebar page penduduk
        isPendudukMenuOpen: false,
        togglePendudukMenu() {
            this.isPendudukMenuOpen = !this.isPendudukMenuOpen;
        },
        // dropdown sidebar page keluarga
        isKeluargaMenuOpen: false,
        toggleKeluargaMenu() {
            this.isKeluargaMenuOpen = !this.isKeluargaMenuOpen;
        },
        // dropdown sidebar page pasangan
        isPasanganMenuOpen: false,
        togglePasanganMenu() {
            this.isPasanganMenuOpen = !this.isPasanganMenuOpen;
        },
        // dropdown sidebar page menu Keluarga Berencana
        isKbMenuOpen: false,
        toggleKbMenu() {
            this.isKbMenuOpen = !this.isKbMenuOpen;
        },
        // dropdown sidebar page menu pelayanan ibu hamil
        isIbuHamilMenuOpen: false,
        toggleIbuHamilMenu() {
            this.isIbuHamilMenuOpen = !this.isIbuHamilMenuOpen;
        },

        // Modal
        isModalOpen: false,
        trapCleanup: null,
        openModal() {
            this.isModalOpen = true;
            this.trapCleanup = focusTrap(document.querySelector("#modal"));
        },
        closeModal() {
            this.isModalOpen = false;
            this.trapCleanup();
        },
    };
}
