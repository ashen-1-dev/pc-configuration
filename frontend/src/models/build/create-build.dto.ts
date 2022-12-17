export class CreateBuildDto {
	public name: string;
	public description?: string;
	public componentsIds: number[];
}

export class CheckCompatibleDto {
	public componentsIds: number[];
}
