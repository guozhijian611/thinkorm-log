<?php
namespace Saithink\ThinkOrmLog;

use Webman\Bootstrap;
use think\facade\Db;
use support\Log;

/**
 * 日志记录类
 */
class BootstrapLog implements Bootstrap
{
    public static function start($worker)
    {
        $config = config('plugin.saithink.thinkorm-log.app', [
            'enable' => true,
            'console'   => false,
            'file'  => true,
        ]);
        if (!$config['enable']) {
            return;
        }
        // 进行监听处理
        Db::listen(function($sql, $runtime) use ($config) {
            if ($sql === 'select 1') {
                // 心跳
                return;
            }
            $log = $sql." [{$runtime}s]";
            // 打印到控制台
            if ($config['console']) {
                echo "[".date("Y-m-d H:i:s")."]"."\033[32m".$log."\033[0m".PHP_EOL;
            }
            // 记录到日志文件
            if ($config['file']) {
                Log::channel('plugin.saithink.thinkorm-log.sql')->info($log);
            }
        });
    }
}