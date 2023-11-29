<p align="center"><a href="https://lunarphp.io/" target="_blank"><picture><source media="(prefers-color-scheme: dark)" srcset="https://raw.githubusercontent.com/lunarphp/art/main/lunar-logo-dark.svg"><img alt="Lunar" width="200" src="https://raw.githubusercontent.com/lunarphp/art/main/lunar-logo.svg"></picture></a></p>

[Lunar](https://lunarphp.io) is a set of Laravel packages that bring functionality akin to Shopify and other e-commerce platforms to Laravel. You have complete freedom to create your own storefront(s), but we've already done the hard work for you in the backend.

This repository serves as a monorepo for the main packages that make up Lunar.

## Requirements

- PHP ^8.1
- Laravel 9+
- MySQL 8.0+ / PostgreSQL 9.2+

## Documentation

- [Full documentation](https://docs.lunarphp.io/) - Includes in-depth guides on everything Lunar

## Contribution

- Bug reports should be submitted as a new Github issue
- Enhancements should [be in discussions](https://github.com/lunarphp/lunar/discussions/new?category=enhancements)
- Feature requests should [be in discussions](https://github.com/lunarphp/lunar/discussions/new?category=feature-requests)

## Community

- [Join our discord server](https://discord.gg/v6qVWaf) and chat to the developers and people using Lunar.
- [We have a roadmap](https://github.com/orgs/lunarphp/projects/1) where we will be detailing which features are next.

## Development, debugging and (local) testing 

### VSC devcontainer
A Docker based VSC devcontainer is available for development, debugging and simple testing. 
- PHP version (8.1/8.2) has to be selected inside `./.devcontainer/docker-compose.yml` file with the image tag (`lunar:php8.1` or `lunar:php8.2`) before vsc conncts to the devcontainer (rebuild is required).
- Lunar version (branch) must be selected using `git checkout`.
- Laravel version (9/10) must be changed via composer e.G. `laravel/framework:^9` or `laravel/framework:^10` (inside the running devcontainer).

### Multi environment testing
Run all or spcific (--filter=*) tests with `./test/run` in Docker environments that meet the system requirements. The tests are executed parallel in separate containers and use [ParaTest](https://github.com/paratestphp/paratest) to run in parallel within the containers. If needed, you can use most of the command line options from [ParaTest](https://github.com/paratestphp/paratest) with `./test/run`, too.
- PHP 8.1 + Laravel 9
- PHP 8.1 + Laravel 10
- PHP 8.2 + Laravel 9
- PHP 8.2 + Laravel 10

## Packages in this monorepo

### Admin hub

The admin hub provided to enable you to manage your store via a modern interface. You can manage all aspects of your store including products, orders, staff members etc. It's built on using Laravel livewire and can be extended to meet each of your stores requirements.

### Core

The core Lunar package, this provides all the things needed for your store to function. This is where all the models, actions and utilities live and is required by the admin hub.

---

## License

Lunar is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
