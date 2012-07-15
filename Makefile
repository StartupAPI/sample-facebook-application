all:	checkconfig updatecode updateusers 

checkconfig:
ifeq "$(wildcard config.php)" ""
	@echo =
	@echo =	You must create config.php file first
	@echo =	Start by copying config.sample.php
	@echo =
	@exit 1
endif

updatecode:
ifneq "$(wildcard .git )" ""
	git pull origin master
	git submodule init
	git submodule update
endif

updateusers:
	cd users && $(MAKE)

rel:	release
release: assets releasetag packages

releasetag:
ifndef v
	# Must specify version as 'v' param
	#
	#   make rel v=1.1.1
	#
else
	#
	# Tagging it with release tag
	#
	git tag -a REL_${subst .,_,${v}}
	git push --tags
endif

packages:
ifndef v
	# Must specify version as 'v' param
	#
	#   make rel v=1.1.1
	#
else
	# generate the package
	git clone . facebook_app_${v}
	cd facebook_app_${v} && git checkout REL_${subst .,_,${v}}
	cd facebook_app_${v} && ${MAKE} updatecode
	cd facebook_app_${v}/users && ${MAKE} updatecode
	cd facebook_app_${v} && ${MAKE} assets 
	cd facebook_app_${v} && find ./ -name "\.git*" | xargs -n10 rm -r

	tar -c facebook_app_${v} |bzip2 > facebook_app_${v}.tar.bz2
	zip -r facebook_app_${v}.zip facebook_app_${v}
	rm -rf facebook_app_${v}
endif
