import React, { useState } from "react";
import {
    Box,
    Button,
    Container,
    CssBaseline,
    Grid,
    TextField,
    Typography,
} from "@mui/material";
import { validateEmail } from "../services/ValidationServices";
import { useAuthStore } from "../store/AppStore";
import Cookies from "js-cookie";
import { useNavigate } from "react-router";
import { Link } from "react-router-dom";

const LoginSection = () => {
    const { setLoggedIn } = useAuthStore();
    const navigate = useNavigate();
    const [message, setMessage] = useState(null);
    const [errors, setErrors] = useState({ email: "", password: "" });

    const handleSubmit = (event) => {
        event.preventDefault();
        const data = new FormData(event.currentTarget);
        setMessage(null);

        const formErrors = { email: "", password: "" };

        if (!validateEmail(data.get("email"))) {
            formErrors.email = "Invalid email address";
        }

        if (!data.get("password")) {
            formErrors.password = "Password is required";
        }

        setErrors(formErrors);

        if (!formErrors.email && !formErrors.password) {
            login({
                email: data.get("email"),
                password: data.get("password"),
            });
        }
    };

    const login = (data) => {
        axios
            .post("/api/auth/login", data)
            .then((response) => {
                if (response.data && response.data.token) {
                    const expirationTime = new Date();
                    expirationTime.setTime(
                        expirationTime.getTime() + 60 * 60 * 1000
                    );
                    // Set token cookie
                    Cookies.set("token", response.data.token);
                    navigate("/dashboard");
                    setLoggedIn(response.data);
                } else {
                    setMessage(response.data.message);
                }
            })
            .catch((error) => {
                console.error(error);
                setMessage("An error occurred during login");
            });
    };

    return (
        <Container component="div" maxWidth="xs">
            <CssBaseline />
            <Box
                sx={{ marginTop: 8, display: "flex", flexDirection: "column" }}
            >
                <Box
                    component="form"
                    onSubmit={handleSubmit}
                    noValidate
                    sx={{ mt: 25, alignItems: "center" }}
                >
                    <Typography
                        component="h1"
                        variant="h5"
                        sx={{ textAlign: "center" }}
                    >
                        Sign in
                    </Typography>
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        id="email"
                        label="Email Address"
                        name="email"
                        autoComplete="email"
                        autoFocus
                        error={!!errors.email}
                        helperText={errors.email}
                    />
                    <TextField
                        margin="normal"
                        required
                        fullWidth
                        name="password"
                        label="Password"
                        type="password"
                        id="password"
                        autoComplete="current-password"
                        error={!!errors.password}
                        helperText={errors.password}
                    />
                    {message && (
                        <Box>
                            <Typography variant="body1" color="error">
                                {message}
                            </Typography>
                        </Box>
                    )}
                    <Button
                        type="submit"
                        fullWidth
                        variant="contained"
                        sx={{ mt: 3, mb: 2 }}
                    >
                        Sign In
                    </Button>
                    <Grid container>
                        <Grid item>
                            <Link to="/registration" variant="body2">
                                {"Don't have an account? Sign Up"}
                            </Link>
                        </Grid>
                    </Grid>
                </Box>
            </Box>
        </Container>
    );
};

export default LoginSection;
