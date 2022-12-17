import { GetComponentDto } from '../../models/component/get-component.dto';
import { axiosInstance } from '../../config/axios';
import { CreateComponentDto } from '../../models/component/create-component.dto';
import { serialize } from 'object-to-formdata';
import { ComponentQuery } from './component-query';
import { getUrlQueryStringFromObject } from '../../utils/uri';

class ComponentServiceImpl {
	public async getComponents(
		componentQuery?: ComponentQuery,
	): Promise<GetComponentDto[]> {
		return await axiosInstance
			.get<GetComponentDto[]>(
				`/components?${getUrlQueryStringFromObject(componentQuery)}`,
			)
			.then(response => response.data);
	}

	public async deleteComponent(id: number): Promise<void> {
		return await axiosInstance.delete(`/components/${id}`);
	}

	public async createComponent(
		createComponentDto: CreateComponentDto,
	): Promise<GetComponentDto[]> {
		const formData = serialize(createComponentDto, { indices: true });
		return await axiosInstance
			.post<GetComponentDto[]>('/components', formData)
			.then(response => response.data);
	}
}

export default new ComponentServiceImpl();
