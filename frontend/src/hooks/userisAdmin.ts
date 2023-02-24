import {useContext} from "react";
import {UserContext} from "../App";
import {checkIsAdmin} from "../utils/user/check-is-admin";

export const userisAdmin = (): boolean => {
	const user = useContext(UserContext);
	return (user && checkIsAdmin(user)) ?? false
}