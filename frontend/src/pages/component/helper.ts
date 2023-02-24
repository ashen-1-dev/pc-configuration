import {CreateComponentDto} from '../../models/component/create-component.dto';

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
	return dto;
};

export const convertDataToUpdateComponentDto = (
	data: any,
): Partial<CreateComponentDto> => {
	const dto: Partial<CreateComponentDto> = {
		name: data?.name,
		type: data?.type,
		photo: data?.photo,
		description: data?.description,
		attributes: [...data?.attributes || [], ...(data?.attributesOptional || [])],
	};
	return dto;
};