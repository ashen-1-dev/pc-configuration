import {axiosInstance} from "../../config/axios";
import {UpdateUserDto} from "../../models/user/update-user.dto";
import {GetUserDto} from "../../models/user/get-user.dto";
import {serialize} from "object-to-formdata";

class UserServiceImpl {
	public async updateUser(updateUserDto: UpdateUserDto): Promise<GetUserDto> {
		const formData = serialize(updateUserDto)
		return await axiosInstance
			.post<GetUserDto>('/user', formData)
			.then(response => response.data);
	}
}

export default new UserServiceImpl();
