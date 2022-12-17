import {
	CheckCompatibleDto,
	CreateBuildDto,
} from '../../models/build/create-build.dto';
import { axiosInstance } from '../../config/axios';
import { CheckBuildResult } from '../../models/build/check-build.result';
import { GetBuildDto } from '../../models/build/get-build.dto';

class BuildServiceImpl {
	public async checkBuildIsReady(
		checkCompatibleDto: CheckCompatibleDto,
	): Promise<CheckBuildResult> {
		return await axiosInstance
			.post<CheckBuildResult>('/builds/check', checkCompatibleDto)
			.then(response => response.data);
	}

	public async createBuild(
		createBuildDto: CreateBuildDto,
	): Promise<GetBuildDto> {
		return await axiosInstance
			.post<GetBuildDto>('/builds', createBuildDto)
			.then(response => response.data);
	}
}

export default new BuildServiceImpl();
