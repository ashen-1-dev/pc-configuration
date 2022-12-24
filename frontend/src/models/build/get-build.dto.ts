import { GetComponentDto } from '../component/get-component.dto';
import { GetUserDto } from '../user/get-user.dto';

export class GetBuildDto {
	public id: number;
	public name: string;
	public isReady: boolean;
	public description?: string;
	public user: GetUserDto;
	public components: GetComponentDto[];
}
