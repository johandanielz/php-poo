FROM php:8.3-cli

RUN apt-get update \
    && apt-get install -y --no-install-recommends git unzip openssh-client \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

ARG USERNAME=dev
ARG USER_ID=1000
RUN useradd --uid $USER_ID --create-home --shell /bin/bash $USERNAME

USER $USERNAME