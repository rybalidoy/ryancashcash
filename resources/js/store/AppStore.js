import { create } from "zustand";
import { persist } from "zustand/middleware";

const initialAuthState = {
    authenticated: false,
    role: "",
    email: "",
};

const useAuthStore = create(
    persist(
        (set, get) => ({
            ...initialAuthState,
            setLoggedIn: (data) => {
                return set((state) => ({
                    ...state,
                    email: data.email,
                    role: data.role,
                    authenticated: true,
                }));
            },
        }),
        {
            name: "authStorage", // Specify a name for the persisted state
        }
    )
);

const initialSnackbarState = {
    message: "hello",
    severity: "info",
    open: false,
};

const useSnackbarStore = create((set) => ({
    ...initialSnackbarState,

    show: (message, severity) => {
        return set((state) => {
            const tempState = {
                message: message,
                severity: severity || initialSnackbarState.severity,
            };
        });
    },
    hide: () => {
        return set((state) => ({ open: false }));
    },
}));

export { useAuthStore, useSnackbarStore };
