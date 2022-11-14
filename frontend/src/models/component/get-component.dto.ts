import { ComponentType } from '../type/types';

export class GetAttributesDto {
	name: string;
	value: number | string | boolean;
}

export class GetComponentDto {
	id: number;
	type: ComponentType;
	name: string;
	description?: string;
	photoUrl?: string;
	attributes: GetAttributesDto[];
}
