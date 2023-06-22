pipeline {
     agent any
     
        environment {
        //once you create ACR in Azure cloud, use that here
        registryName = "tallyho"
        //- update your credentials ID after creating credentials for connecting to ACR
        registryCredential = 'ACR'
        dockerImage = 'tallyho.azurecr.io/tallyho:latest'
        registryUrl = 'tallyho.azurecr.io'
    }
    
    stages {
        
        stage ('checkout') {
            steps {
            checkout scmGit(branches: [[name: '*/main']], extensions: [], userRemoteConfigs: [[url: 'https://github.com/codytron21/tallyho']])
            }
        }
        
        stage ('Build Docker image') {
            steps {
                script{
                     sh 'docker-compose build'
                     sh "docker tag tallyho-docker-compose-pipeline-php-apache-tallyho:latest tallyho.azurecr.io/tallyho:latest"
                }
                
                }
        }
       
         // // Uploading Docker images into ACR
        stage('Upload Image to ACR') {
           steps{   
               script {
                 docker.withRegistry( "http://${registryUrl}", registryCredential ) {
                  sh 'docker push ${dockerImage}'
                }
         }
       }
     }
   }
 }
