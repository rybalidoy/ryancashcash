import { useAuthStore } from "../store/AppStore";
import React from "react";

export const detectRole = (userRole) => {
    const { role } = useAuthStore();

    if (role === userRole) return true;
};

export const permitWithFallback = ({ role, fallback, ...props }) => {
    fallback = fallback || <UnauthorizedSection />;

    if (detectRole(role)) return props.children;

    return fallback;
};

const Role = ({ role, ...props }) => {
    if (!detectRole(role)) return undefined;

    return <React.Fragment {...props}></React.Fragment>;
};

export default Role;
