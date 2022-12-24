import {
	CheckCompatibleDto,
	CreateBuildDto,
	UpdateBuildDto,
} from '../../models/build/create-build.dto';
import { axiosInstance } from '../../config/axios';
import { CheckBuildResult } from '../../models/build/check-build.result';
import { GetBuildDto } from '../../models/build/get-build.dto';
import { BuildQuery } from '../../models/build/build.query';
import { getUrlQueryStringFromObject } from '../../utils/uri';

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

	public async getBuilds(buildQuery?: BuildQuery): Promise<GetBuildDto[]> {
		return await axiosInstance
			.get<GetBuildDto[]>(
				`/builds?${getUrlQueryStringFromObject(buildQuery)}`,
			)
			.then(response => response.data);
	}

	public async getAuthUserBuilds(): Promise<GetBuildDto[]> {
		return await axiosInstance
			.get<GetBuildDto[]>(`/users/builds/my`)
			.then(response => response.data);
	}

	public async addUsersBuild(buildId: number): Promise<GetBuildDto> {
		return await axiosInstance
			.get<GetBuildDto>(`/builds/${buildId}/add`)
			.then(response => response.data);
	}

	public async removeBuild(buildId: number): Promise<void> {
		return await axiosInstance.delete(`/builds/${buildId}`);
	}

	public async updateBuild(
		buildId: number,
		updateBuildDto: UpdateBuildDto,
	): Promise<GetBuildDto> {
		return await axiosInstance
			.put<GetBuildDto>(`/builds/${buildId}`, updateBuildDto)
			.then(response => response.data);
	}
}

export default new BuildServiceImpl();
