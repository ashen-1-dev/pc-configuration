import {GetRoleDto} from "./get-role.dto";

export class GetUserDto {
	public id?: number;
	public email: string;
	public firstName: string;
	public lastName: string;
	public photoUrl?: string
	public roles?: GetRoleDto[]
}
