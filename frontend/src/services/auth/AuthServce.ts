import {axiosInstance} from '../../config/axios';
import {LoginDto} from '../../models/auth/login.dto';
import {RegisterDto} from '../../models/auth/register.dto';
import {SuccessLoginDto} from '../../models/auth/success-login.dto';
import {GetUserDto} from '../../models/user/get-user.dto';
import {serialize} from "object-to-formdata";
import {removeAuthToken} from "../../utils/storage";

class AuthServceImpl {
	public async login(loginDto: LoginDto): Promise<SuccessLoginDto> {
		return await axiosInstance
			.post<SuccessLoginDto>('/login', loginDto)
			.then(response => response.data);
	}

	public async register(registerDto: RegisterDto): Promise<SuccessLoginDto> {
		const formData = serialize(registerDto, {indices: true});
		return await axiosInstance
			.post<SuccessLoginDto>('/register', formData)
			.then(response => response.data);
	}

	public async authUser(): Promise<GetUserDto | null> {
		return await axiosInstance
			.get<GetUserDto>('/users/me')
			.then(response => response.data)
			.catch(error => {
				removeAuthToken();
				return null;
			})
	}
}

export default new AuthServceImpl();
