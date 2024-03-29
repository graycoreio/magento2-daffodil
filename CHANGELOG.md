# Changelog

All notable changes to this project will be documented in this file. See [standard-version](https://github.com/conventional-changelog/standard-version) for commit guidelines.

## [0.2.2](https://github.com/graycoreio/magento2-daffodil/compare/v0.2.1...v0.2.2) (2023-12-20)


### Features

* **sitemap:** make sitemap 8.1 compat ([#22](https://github.com/graycoreio/magento2-daffodil/issues/22)) ([e53fd3a](https://github.com/graycoreio/magento2-daffodil/commit/e53fd3a99513b654a973f2feccfd4c8e3c4dc403))


### Bug Fixes

* **email:** set scope correctly on admin emails ([bc984a6](https://github.com/graycoreio/magento2-daffodil/commit/bc984a69141aeab581803af0755cec067f28adfa))
* fixing wrong redirect when restoring admin password ([#24](https://github.com/graycoreio/magento2-daffodil/issues/24)) ([d4ecb56](https://github.com/graycoreio/magento2-daffodil/commit/d4ecb56c51127457112821072d50ce3bb5050722))


### Miscellaneous Chores

* add release-please support ([589ab8d](https://github.com/graycoreio/magento2-daffodil/commit/589ab8d3606f7b692295cdd5dae9a3171b02b37f))

### [0.2.1](https://github.com/graycoreio/magento2-daffodil/compare/v0.2.0...v0.2.1) (2022-12-15)


### Features

* **routemap, email:** make routermap more precise ([32bc5c9](https://github.com/graycoreio/magento2-daffodil/commit/32bc5c92a00cf8975560db485c454bf87963ef72))

## [0.2.0](https://github.com/graycoreio/magento2-daffodil/compare/v0.1.4...v0.2.0) (2022-04-14)


### ⚠ BREAKING CHANGES

* **emails:** this commit is only compatible with v2.4.3-p1 and forward as a result of https://github.com/magento/magento2/commit/dd350a7b13fb65d39051dfb2f7db44b48cf18da1

### Features

* **emails:** allow daffodilurl in emails ([41a5f80](https://github.com/graycoreio/magento2-daffodil/commit/41a5f8096261f72118030a9e0f4970378f74f9c5))
* add product URL modifier plugin ([#6](https://github.com/graycoreio/magento2-daffodil/issues/6)) ([4550ba4](https://github.com/graycoreio/magento2-daffodil/commit/4550ba43e98579e99e1e69ceb4ef55b28213ed2a))

### [0.1.4](https://github.com/graycoreio/magento2-daffodil/compare/v0.1.3...v0.1.4) (2021-08-23)


### Features

* **sitemap:** make sitemap use Daffodil url ([#10](https://github.com/graycoreio/magento2-daffodil/issues/10)) ([dc7e4c4](https://github.com/graycoreio/magento2-daffodil/commit/dc7e4c4ca55dd5ffb30f5505beb4510090db2384))

### [0.1.3](https://github.com/graycoreio/magento2-daffodil/compare/v0.1.2...v0.1.3) (2021-04-30)


### Features

* **mapper,email:** apply route mapping to {{ store }} directive ([#1](https://github.com/graycoreio/magento2-daffodil/issues/1)) ([1b8771a](https://github.com/graycoreio/magento2-daffodil/commit/1b8771afaf8ffe10b9eead6dc63f302c33725928))

### [0.1.2](https://github.com/graycoreio/magento2-daffodil/compare/v0.1.1...v0.1.2) (2021-02-10)


### Features

* **configuration:** fix a bad function name ([d273b93](https://github.com/graycoreio/magento2-daffodil/commit/d273b93880561df73046e38a52b7e6fee2a10a6d))
* **routing:** add a plugin to override the url of a category ([e9315f9](https://github.com/graycoreio/magento2-daffodil/commit/e9315f9380985613e31622220a0816984aa14c57))

### 0.1.1 (2020-11-09)


### Features

* **configuration:** fix a poorly named configuration value ([634b938](https://github.com/graycoreio/magento2-daffodil/commit/634b938e629c235a250c079c37027109866d801c))
* **emails:** add configuration and mapping layer to swap email urls to customizable urls ([1ccad4c](https://github.com/graycoreio/magento2-daffodil/commit/1ccad4c89d26bbc96caf7ea25771a83961c36da9))
