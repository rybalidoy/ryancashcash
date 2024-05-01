import { Skeleton } from "@mui/material";
import React from "react";

const Suspense = (props) => {
    return (
        <React.Suspense
            {...props}
            fallback={<Skeleton variant="text" sx={{ fontSize: "1rem" }} />}
        />
    );
};

export default Suspense;
