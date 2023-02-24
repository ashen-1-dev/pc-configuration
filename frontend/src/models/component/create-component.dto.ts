export class CreateComponentDto {
	name: string;
	description?: string;
	photo?: File;
	attributes: CreateAttributesDto[];
	type: string;
}

export class CreateAttributesDto {
	name: string;
	value: string | boolean | number;
}