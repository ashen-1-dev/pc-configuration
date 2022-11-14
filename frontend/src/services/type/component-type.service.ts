import { GetComponentTypeDto } from '../../models/type/GetComponentType.dto';
import { axiosInstance } from '../../config/axios';
import { GetRequiredAttributesDto } from '../../models/type/GetRequiredAttributes.dto';

class ComponentTypeServiceImpl {
	public async getComponentTypes(): Promise<GetComponentTypeDto[]> {
		return await axiosInstance
			.get<GetComponentTypeDto[]>('/component-types/')
			.then(response => response.data);
	}

	public async getRequiredAttributes(
		type: string,
	): Promise<GetRequiredAttributesDto[]> {
		return await axiosInstance
			.get(`/component-types/${type}/attributes`)
			.then(response => response.data);
	}
}

export default new ComponentTypeServiceImpl();
