import { Alert, Snackbar } from "@mui/material";
import { useSnackbarStore } from "../../store/AppStore";

const AppSnackbar = () => {
    const { message, severity, open, hide } = useSnackbarStore();
    const autoHideDuration = 3000;

    const handleSnackbarClose = (event, reason) => {
        if (reason == "clickaway") {
            return;
        }

        hide();
    };

    return (
        <Snackbar
            open={open}
            autoHideDuration={autoHideDuration}
            onClose={handleSnackbarClose}
            anchorOrigin={{ vertical: "bottom", horizontal: "center" }}
        >
            <Alert
                onClose={handleSnackbarClose}
                severity={severity}
                sx={{ width: "100%" }}
            >
                {message}
            </Alert>
        </Snackbar>
    );
};
export default AppSnackbar;
