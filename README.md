# Group-Co

[![Build Status](https://travis-ci.org/fucongcong/co-framework.svg?branch=master)](https://travis-ci.org/fucongcong/Group-Co)  [![Code Climate](https://codeclimate.com/github/fucongcong/co-framework/badges/gpa.svg)](https://github.com/fucongcong/Group-Co)

### 为什么写这个框架？

* 利用协程特性以同步方式来编写异步代码，增强可读性。
* 将swoole的异步特性与传统框架的MVC相结合。
* 可以用作api也可以用作http server,rpc server.
* 目前实现了以Zookeeper、Redis、Mysql为注册中心的服务化治理.

### 如何使用，与传统框架的区别？

* 框架基本使用与传统框架基本一致，路由，控制器，服务层，数据层。
* 在异步调用的地方需要以yield关键词来触发协程切换

#### 生产环境使用

* GroupCo框架目前已经全线用于我们团队，日均处理请求百万次，基础服务调用耗时平均约为0.1ms

### 特性

* 全异步协程调度，支持高并发
* 服务发现，客户端缓存、心跳检测、服务监听
* 统一配置中心
* 异步TCP，HTTP客户端
* 异步日志
* 异步文件读写
* 异步Mysql
* 异步Mysql事务处理
* 异步Redis
* 支持Mysql连接池,Redis连接池
* SOA服务化调用，内部封装完整的RPC通信，服务端采用异步Task处理后合并数据并返回。
* 异步TCP客户端支持并行、串行调用
* 支持EOF结束符协议、自定义网络通信协议，支持json化、php序列化包体，支持gzip。
* Twig、Doctrine支持视图、服务数据层
* 单元测试覆盖

### 文档总览

* 快速开始
  * [环境依赖](doc/yin-yan/huan-jing-yi-lai.md)
  * [启动项目](doc/yin-yan/qi-dong-xiang-mu.md)
* 异步服务
  * [异步Tcp客户端](doc/kuang-jia-fu-wu/yi-bu-tcp-ke-hu-duan.md)
  * [异步Http客户端](doc/kuang-jia-fu-wu/yi-bu-http-ke-hu-duan.md)
  * [异步Redis客户端](doc/kuang-jia-fu-wu/sd.md)
  * [异步Mysql客户端](doc/kuang-jia-fu-wu/yi-bu-mysql-ke-hu-duan.md)
  * [异步Log日志](doc/kuang-jia-fu-wu/yi-bu-log.md)
  * [异步文件读写](doc/kuang-jia-fu-wu/yi-bu-wen-jian-du-xie.md)
  * [异常Exception](doc/kuang-jia-fu-wu/yi-chang-exception.md)
* 服务中心
  * [服务治理流程](doc/fu-wu-zhong-xin/fu-wu-zhi-li-liu-cheng.md)
  * [注册中心](doc/fu-wu-zhong-xin/zhu-ce-zhong-xin.md)
  * [服务调用](doc/fu-wu-zhong-xin/yi-bu-http-server-zhong-shi-yong-fu-wu.md)
  * [服务调用监控](doc/fu-wu-zhong-xin/fu-wu-diao-yong-jian-kong.md)
  * [服务调用失败事件](doc/fu-wu-zhong-xin/fu-wu-diao-yong-shi-bai.md)
  * [调试模式](doc/fu-wu-zhong-xin/diao-shi-mo-shi.md)
* 配置中心
  * [配置中心的使用](doc/pei-zhi-zhong-xin/shi-yong.md)
* 基础服务
  * [Config配置类](doc/ji-chu-fu-wu/config.md)
  * [StaticCache静态缓存类](doc/ji-chu-fu-wu/staticcache.md)
  * [Route路由类](doc/ji-chu-fu-wu/routelu-you-lei.md)
  * [Controller控制器类](doc/ji-chu-fu-wu/controllerkong-zhi-qi-lei.md)
  * [View视图类](doc/ji-chu-fu-wu/viewshi-tu-lei.md)
  * [Request请求类](doc/ji-chu-fu-wu/requestqing-qiu-lei.md)
  * [Response响应类](doc/ji-chu-fu-wu/responsexiang-ying-lei.md)
  * [Event事件类](doc/ji-chu-fu-wu/eventshi-jian-lei.md)
  * [Listener监听类](doc/ji-chu-fu-wu/listenerjian-ting-lei.md)
  * [Subscriber多事件监听](doc/ji-chu-fu-wu/subscriberduo-shi-jian-jian-ting.md)
  * [EventDispatcher事件调度](doc/ji-chu-fu-wu/eventdispatchershi-jian-diao-du-lei.md)
* 同步服务\(用于服务开发\)
  * [Service](doc/tong-bu-fu-wu/service.md)
  * [Dao](doc/tong-bu-fu-wu/dao.md)
  * [Cache](doc/tong-bu-fu-wu/rediscache.md)
  * [Log日志类](doc/tong-bu-fu-wu/logri-zhi-lei.md)
  * [FileCache文件缓存类](doc/tong-bu-fu-wu/filecachewen-jian-huan-cun-lei.md)
* [单元测试](doc/dan-yuan-ce-shi/dan-yuan-ce-shi.md)
* [控制台](doc/kong-zhi-tai/kong-zhi-tai.md)

### 案例Demo与最佳实践(即将更新)
- [实现服务异常邮件通知](doc/demo/fu-wu-yi-chang.md)
- [秒杀系统,与GO切磋](https://github.com/fucongcong/GroupCo/tree/co/seckill)
- [日志分析服务](doc/demo/log.md)
- Api服务

### BUG反馈
如果你在使用过程中遇到安全或者框架层面使用bug，请提issue。

### 理想的架构模型
- [架构选型](doc/fu-wu-zhong-xin/jiagou.md)

### 与Go的协程的区别
基于Swoole的异步与php的Generator实现的异步协程，而go语言是内置协程，这是本质上的区别。swoole2.0以上版本开始支持内置协程，在触发io时会触发协程调度，不过还未稳定,但是重新定义了PHP，使得PHP可以支持更大的并发，做更多的事情。
