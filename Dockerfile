##
# Stage: base
#
# Build app server
##
FROM ghcr.io/joomlatools/pages-server:latest as base

##
# START: custom Docker instructions
##

RUN apt-get install -y --no-install-recommends rolldice

### Gitpod user ###

# '-l': see https://docs.docker.com/develop/develop-images/dockerfile_best-practices/#user
RUN useradd -l -u 33333 -G sudo -md /home/gitpod -s /bin/bash -p gitpod gitpod \
    # passwordless sudo for users in the 'sudo' group
    && sed -i.bkp -e 's/%sudo\s\+ALL=(ALL\(:ALL\)\?)\s\+ALL/%sudo ALL=NOPASSWD:ALL/g' /etc/sudoers \

ENV HOME=/home/gitpod
WORKDIR $HOME
USER gitpod


##
# END:  custom Docker instructions
##

# --- DO NOT MODIFY BELOW ----------------------------------------------------------------------------------------------

##
# Stage: build
#
# Note: Using a scratch image doesn't work with Gitpod
##

#FROM scratch as build

# Copy all from base
#COPY --from=base / .

# Clean up apt cache and temp files to save disk space
#RUN /bin/bash -e /var/scripts/apt_clean.sh;
#RUN /bin/bash -e /var/scripts/apt_purge.sh;

# Run S6 overlay
ENTRYPOINT ["/init"]