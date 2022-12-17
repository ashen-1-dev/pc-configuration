import { axiosInstance } from '../../config/axios';
import { LoginDto } from '../../models/auth/login.dto';
import { RegisterDto } from '../../models/auth/register.dto';
import { SuccessLoginDto } from '../../models/auth/success-login.dto';
import { GetUserDto } from '../../models/user/get-user.dto';

class AuthServceImpl {
	public async login(loginDto: LoginDto): Promise<SuccessLoginDto> {
		return await axiosInstance
			.post<SuccessLoginDto>('/login', loginDto)
			.then(response => response.data);
	}

	public async register(registerDto: RegisterDto): Promise<SuccessLoginDto> {
		return await axiosInstance
			.post<SuccessLoginDto>('/register', registerDto)
			.then(response => response.data);
	}

	public async authUser(): Promise<GetUserDto> {
		return await axiosInstance
			.get<GetUserDto>('/users/me')
			.then(response => response.data);
	}
}

export default new AuthServceImpl();
