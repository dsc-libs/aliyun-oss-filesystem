<?php

namespace Jewdore\AliyunOssFileSystem\FileSystem\Plugins;

use OSS\OssClient;

class GetTemporaryUrl extends AliyunOssAbstractPlugin
{
    /**
     * @return string
     */
    public function getMethod()
    {
        return 'getTemporaryUrl';
    }

    /**
     * @param string $path
     * @param int $timeout
     * @param string $method
     * @param array $config
     * @return string
     * @throws \OSS\Core\OssException
     */
    public function handle($path, $timeout = 3600, $method = OssClient::OSS_HTTP_GET, $config = [])
    {
        return $this->adapter->getClient()
            ->signUrl(
                $this->adapter->getBucket(),
                $this->adapter->applyPathPrefix($path),
                $timeout,
                $method,
                $this->adapter->getOptionsFromConfig($this->prepareConfig($config))
            );
    }
}
