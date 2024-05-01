import "./bootstrap";
import React from "react";
import { BrowserRouter } from "react-router-dom";
import { Grid } from "@mui/material";
import AxiosInterceptor from "./components/auth/AxiosResponseInterceptor";
import Content from "./components/Content";
import Navbar from "./components/Navbar";

const AppSnackbar = React.lazy(() => import("./components/auth/AppSnackbar"));

const App = () => {
    return (
        <BrowserRouter>
            <AxiosInterceptor />
            <AppSnackbar />
            <Grid container spacing={2}>
                <Grid item xs={2}>
                    <Navbar />
                </Grid>
                <Grid item xs={10}>
                    <Content />
                </Grid>
            </Grid>
        </BrowserRouter>
    );
};

export default App;
