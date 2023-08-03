# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.3] - 2023-08-03

### Added
- Changelog file.

### Changed
- Locked the text color of the popup to black.

## [1.0.2] - 2023-07-27

### Changed
- Changed the default triggered environments from `local` to `local`, `dev` and `development`.
- Changed that the ribbon is disabled when the `app.debug` flag is set to `false`.

### Fixed
- phpunit tests didn't work because of a missing `app.debug` flag.

## [1.0.1] - 2023-07-27

### Added

- Introduced colors for the changed files to indicate the status of the git work directory.

### Changed

- Changed the html to avoid conflicts with user defined css by using div's and spans instead of headers.
- Changed the file layout to make it more readable.

## [1.0.0] - 2023-07-26

### Added
- Initial release of the project.

[Unreleased]: https://github.com/jithran/GitRibbon/compare/v1.0.2...HEAD
[1.0.3]: https://github.com/jithran/GitRibbon/compare/v1.0.2...v1.0.3
[1.0.2]: https://github.com/jithran/GitRibbon/compare/v1.0.1...v1.0.2
[1.0.1]: https://github.com/jithran/GitRibbon/compare/v1.0.0...v1.0.1
[1.0.0]: https://github.com/jithran/GitRibbon/releases/tag/v1.0.0
