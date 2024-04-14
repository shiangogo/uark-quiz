import { defineStore } from "pinia";

export const useAuthOptionStore = defineStore("authOption", {
    state: () => ({
        authOption: null,
        baseUrl: document.head.querySelector('meta[name="base-url"]').getAttribute('content'),
    }),

    actions: {
        setAuthOption(authOption) {
            this.authOption = authOption;
        },

        goToLogin() {
            window.history.pushState({}, '', this.baseUrl + '/sessions/new');
            this.setAuthOption(this.authOptions.LOGIN);
        },

        goToRegister() {
            window.history.pushState({}, '', this.baseUrl + '/users/new');
            this.setAuthOption(this.authOptions.REGISTER);
        },

        goToCreateOrganization() {
            window.history.pushState({}, '', this.baseUrl + '/organizations/new');
            this.setAuthOption(this.authOptions.CREATE_ORGANIZATION);
        },
    },

    getters: {
        getAuthOption() {
            return this.authOption;
        },

        authOptions() {
            return {
                LOGIN: 0,
                REGISTER: 1,
                CREATE_ORGANIZATION: 2
            };
        }
    }
});
