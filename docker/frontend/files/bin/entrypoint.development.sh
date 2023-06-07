#!/bin/bash -e

# Install dependencies
echo "# Installing dependencies ..."
yarn install

# Start development server
echo "# Starting dev server ..."
ng serve --host 0.0.0.0
