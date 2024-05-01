import axios from "axios";
import { useEffect } from "react";
import { useLocation, useNavigate } from "react-router";

const promiseResolver = (error) => {
    return Promise.resolve(error);
};

const AxiosInterceptor = () => {
    // Auth
    const navigate = useNavigate();
    const location = useLocation();

    useEffect(() => {
        axios.interceptors.response.use(undefined, function (error) {
            switch (error.response.status) {
                /**
                 *  unauthenticated
                 */
                case 401:
                    return promiseResolver(error);

                case 403:
                    navigate("/unauthorized");
                    return promiseResolver(error);

                case 404:
                    navigate(`/404?origin=${location.pathname}`);
                    return promiseResolver(error);
            }

            return Promise.reject(error);
        });
    }, []);

    return undefined;
};

export default AxiosInterceptor;
