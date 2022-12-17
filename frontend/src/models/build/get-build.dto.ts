import { GetComponentDto } from '../component/get-component.dto';

export class GetBuildDto {
	public id: number;
	public name: string;
	public description?: string;
	public components: GetComponentDto[];
}
