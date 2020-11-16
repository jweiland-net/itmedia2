# TYPO3 Extension `itmedia2`

![Build Status](https://github.com/jweiland-net/itmedia2/workflows/CI/badge.svg)

EXT:itmedia2 is a reduced version of our EXT:yellowpages2

## 1 Features

Create and manage companies

## 2 Usage

### 2.1 Installation

#### Installation using Composer

The recommended way to install the extension is using Composer.

Run the following command within your Composer based TYPO3 project:

```
composer require jweiland/itmedia2
```

#### Installation as extension from TYPO3 Extension Repository (TER)

Download and install `itmedia2` with the extension manager module.

### 2.2 Minimal setup

1) Include the static TypoScript of the extension.
2) Create it-media records on a sysfolder.
3) Create a plugin on a page and select at least the sysfolder as startingpoint.
