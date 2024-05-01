import {
    Collapse,
    Divider,
    ListItemText,
    MenuItem,
    MenuList,
    Paper,
} from "@mui/material";
import { useMatch, useResolvedPath } from "react-router";
import { NavLink } from "react-router-dom";
import { useAuthStore } from "../store/AppStore";
import Role from "./Role";

const CustomLinkMenuItem = ({ children, to, end, ...props }) => {
    const { authenticated } = useAuthStore();
    let resolved = useResolvedPath(to);
    let match = useMatch({ path: resolved.pathname, end: end && true });

    return (
        <MenuItem
            component={NavLink}
            to={to}
            {...props}
            selected={match != null}
        >
            <ListItemText>{children}</ListItemText>
        </MenuItem>
    );
};

const ProtectedLinks = (props) => {
    const { authenticated } = useAuthStore();
    return <Collapse in={authenticated}>{props.children}</Collapse>;
};

const Navbar = () => {
    const { email, authenticated } = useAuthStore();
    return (
        <Paper>
            <MenuList dense>
                <MenuItem disabled>
                    <ListItemText>{"Quick Cash"}</ListItemText>
                </MenuItem>
                <Collapse in={!authenticated}>
                    <Divider />
                </Collapse>
                <Collapse in={authenticated}>
                    <MenuItem
                        disabled
                        sx={{ whiteSpace: "normal", wordWrap: "break-word" }}
                    >
                        <ListItemText>Welcome, {email}</ListItemText>
                    </MenuItem>
                </Collapse>
                <Collapse in={authenticated}>
                    <Divider />
                </Collapse>

                <Collapse in={!authenticated}>
                    <CustomLinkMenuItem>
                        <ListItemText>Login</ListItemText>
                    </CustomLinkMenuItem>
                </Collapse>

                {/** Custom Links when loggedin */}
                <Collapse in={authenticated}>
                    <CustomLinkMenuItem to="/dashboard">
                        Dashboard
                    </CustomLinkMenuItem>
                </Collapse>
                {/** Role Protected Links */}
                <ProtectedLinks>
                    <Role role="payroll officer">
                        <CustomLinkMenuItem to="/company">
                            Company
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/loans">
                            Loan
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/employees">
                            Employee
                        </CustomLinkMenuItem>
                    </Role>
                    <Role role="administrator">
                        <CustomLinkMenuItem to="/company">
                            Company
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/loans">
                            Loan
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/payroll">
                            Payroll
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/employees">
                            Employee
                        </CustomLinkMenuItem>
                    </Role>
                    <Role role="owner">
                        <CustomLinkMenuItem to="/company">
                            Company
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/loan">Loan</CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/employees">
                            Admin
                        </CustomLinkMenuItem>
                        <CustomLinkMenuItem to="/employees">
                            Employee
                        </CustomLinkMenuItem>
                    </Role>
                </ProtectedLinks>
            </MenuList>
        </Paper>
    );
};

export default Navbar;
