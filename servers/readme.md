# Source Engine 游戏服务器查询

本页面会统筹所有已注册的服务器，并在页面显示出详细信息

如：服务器名称，在线玩家数量，游戏模式 等

本页面用到了PHP库，请查看 composer.json 并安装对应的库文件

（在源码打包的时候，vendor文件夹内有文件损坏了，所以源码并不全面，建议重新安装PHP库）

## 添加注册服务器

打开 query.js 文件

根据格式添加以下代码

```js
// 这里的 serverlist[2]，中括号内的数字请确保独一无二，并且从大到小进行排序
serverlist[2] = {
    ["servername"]: "CSS连跳服", // 当服务器离线时的占位名称
    ["serverip"]: "gmod.ltd",   // 服务器IP地址，可以是域名
    ["serverport"]: 54005       // 服务器端口，必须为Intger
}
```