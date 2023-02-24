import {GetUserDto} from "../../models/user/get-user.dto";

export const checkIsAdmin = (user: GetUserDto) => user.roles?.some(role => role.name === 'admin') ?? false;