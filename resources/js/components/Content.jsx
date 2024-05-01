import { Navigate, Outlet, Route, Routes } from "react-router";
import { useAuthStore } from "../store/AppStore";
import { Box } from "@mui/material";
import { Suspense } from "react";
import React from "react";
import Dashboard from "../sections/Dashboard";
import CompanySection from "../sections/CompanySection";
import EmployeeSection from "../sections/EmployeeSection";
import PayrollSection from "../sections/PayrollSection";
import LoanSection from "../sections/LoanSection";

// Lazy loading
const LoginSection = React.lazy(() => import("../sections/LoginSection"));
const RegistrationSection = React.lazy(() =>
    import("../sections/RegistrationSection")
);

function ProtectedRoutes(props) {
    const { authenticated } = useAuthStore();

    if (!authenticated) {
        return <Navigate to="/login" />;
    }
    return <Outlet />;
}

function RedirectToDashboard() {
    const { authenticated } = useAuthStore();

    if (authenticated) {
        return <Navigate to="/dashboard" />;
    }
    return null;
}

const Content = () => {
    return (
        <>
            <Box sx={{ p: 2 }}>
                <Routes>
                    <Route path="/" element={<Navigate to="/dashboard" />} />
                    <Route
                        path="login"
                        element={
                            <Suspense fallback={<div>Loading...</div>}>
                                <RedirectToDashboard />
                                <LoginSection />
                            </Suspense>
                        }
                    />
                    <Route
                        path="registration"
                        element={
                            <Suspense fallback={<div>Loading...</div>}>
                                <RedirectToDashboard />
                                <RegistrationSection />
                            </Suspense>
                        }
                    />

                    {/** Protected Routes */}
                    <Route path="/" element={<ProtectedRoutes />}>
                        <Route path="/dashboard" element={<Dashboard />} />
                        <Route path="/company" element={<CompanySection />} />
                        <Route
                            path="/employees"
                            element={<EmployeeSection />}
                        />
                        <Route path="/loans" element={<LoanSection />} />
                        <Route path="/payroll" element={<PayrollSection />} />
                    </Route>
                </Routes>
            </Box>
        </>
    );
};

export default Content;
