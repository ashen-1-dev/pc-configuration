import { CreateComponentDto } from '../../models/component/create-component.dto';

export const convertDataToCreateComponentDto = (
	data: any,
): CreateComponentDto => {
	const dto: CreateComponentDto = {
		name: data.name,
		type: data.type,
		photo: data.photo,
		description: data.description,
		attributes: [...data.attributes, ...(data.attributesOptional || [])],
	};
	console.log('dto: ', dto);
	return dto;
};
