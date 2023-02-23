<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SystemInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'db_connection' => $this->dbConnection,
            'db_writing' => $this->dbWriting,
            'last_cron_time' => $this->runtime_date,
            'online_since' => $this->onlineTime,
            'memory_use' => $this->memoryUse
        ];
    }
}
